USE [BSUALL2005trial]
GO
/****** Object:  StoredProcedure [dbo].[sp_paymentAP]    Script Date: 2/18/2015 5:06:28 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO




ALTER proc [dbo].[sp_paymentAP]
@vendor varchar(10),
@checkbox int,
@startdate datetime,
@enddate datetime,
@pt int,
@bank int
 as


IF(@checkbox=1)
	BEGIN
		IF(@bank=0)
			BEGIN
				select c.doc_no,c.doc_date,voucher,convert(varchar(12), a.payment_date, 113) as trans_date, convert(varchar(12), a.payment_date, 113) as payment_date, 
				nm_supplier,a.descs, a.voucher, a.amount, f.acc_name as bank_nm, a.paidby from db_cashheader a
				inner join pemasok b on b.kd_supp_gb=a.vendor_acct	
				inner join db_apinvoice c on c.apinvoice_id=a.apinvoice_id
				inner join db_bank e on e.bank_id=a.bankacc
				inner join db_coa f on e.bank_coa=f.acc_no
				inner join db_subproject g on c.project_no = g.subproject_id
				where a.trx_type='BK' and a.payment_date between @startdate and @enddate and g.id_pt = @pt order by a.payment_date
			END
		ELSE
			BEGIN
				select c.doc_no,c.doc_date,voucher,convert(varchar(12), a.payment_date, 113) as trans_date, convert(varchar(12), a.payment_date, 113) as payment_date, 
				nm_supplier,a.descs, a.voucher, a.amount, f.acc_name as bank_nm, a.paidby from db_cashheader a
				inner join pemasok b on b.kd_supp_gb=a.vendor_acct	
				inner join db_apinvoice c on c.apinvoice_id=a.apinvoice_id
				inner join db_bank e on e.bank_id=a.bankacc
				inner join db_coa f on e.bank_coa=f.acc_no
				inner join db_subproject g on c.project_no = g.subproject_id
				where a.trx_type='BK' and e.bank_id=@bank and a.payment_date between @startdate and @enddate and g.id_pt = @pt order by a.payment_date
			END
	END
ELSE
	BEGIN
		IF(@bank=0)
			BEGIN
				select c.doc_no,c.doc_date,voucher,convert(varchar(12), a.payment_date, 113) as trans_date, convert(varchar(12), a.payment_date, 113) as payment_date, 
				nm_supplier,a.descs, a.voucher, a.amount, f.acc_name as bank_nm, a.paidby from db_cashheader a
				inner join pemasok b on b.kd_supp_gb=a.vendor_acct	
				inner join db_apinvoice c on c.apinvoice_id=a.apinvoice_id
				inner join db_bank e on e.bank_id=a.bankacc
				inner join db_coa f on e.bank_coa=f.acc_no
				inner join db_subproject g on c.project_no = g.subproject_id
				where a.trx_type='BK' and c.vendor_acct = @vendor and a.payment_date between @startdate and @enddate and g.id_pt = @pt order by a.payment_date
			END
		ELSE
			BEGIN
				select c.doc_no,c.doc_date,voucher,convert(varchar(12), a.payment_date, 113) as trans_date, convert(varchar(12), a.payment_date, 113) as payment_date, 
				nm_supplier,a.descs, a.voucher, a.amount, f.acc_name as bank_nm, a.paidby from db_cashheader a
				inner join pemasok b on b.kd_supp_gb=a.vendor_acct	
				inner join db_apinvoice c on c.apinvoice_id=a.apinvoice_id
				inner join db_bank e on e.bank_id=a.bankacc
				inner join db_coa f on e.bank_coa=f.acc_no
				inner join db_subproject g on c.project_no = g.subproject_id
				where c.vendor_acct = @vendor and a.trx_type='BK' and e.bank_id=@bank and a.payment_date between @startdate and @enddate and g.id_pt = @pt order by a.payment_date
			END
	END