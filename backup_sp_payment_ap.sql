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

declare @project_detail int

IF @checkbox=1
BEGIN
	IF @project_detail=0
	BEGIN
		if(@bank = 0)
		begin
		select voucher,convert(varchar(12), d.payment_date, 113) as trans_date, convert(varchar(12), a.doc_date, 113) as doc_date, 
		nm_supplier,d.descs, a.doc_no, d.amount, f.acc_name as bank_nm, d.paidby from db_apledger a
		inner join pemasok b on b.kd_supp_gb=a.vendor_acct	
		inner join db_apinvoice c on c.doc_no=a.doc_no
		left join db_cashheader d on d.apinvoice_id=a.ref_no
		inner join db_bank e on e.bank_id=d.bankacc
		inner join db_coa f on e.bank_coa=f.acc_no
		inner join db_subproject g on c.project_no = g.subproject_id
		where d.trx_type='BK' and d.payment_date between @startdate and @enddate and g.id_pt = @pt order by d.payment_date
		end
		else
		begin
		select voucher,convert(varchar(12), d.payment_date, 113) as trans_date, convert(varchar(12), a.doc_date, 113) as doc_date, 
		nm_supplier,d.descs, a.doc_no, d.amount, f.acc_name as bank_nm, d.paidby from db_apledger a
		inner join pemasok b on b.kd_supp_gb=a.vendor_acct	
		inner join db_apinvoice c on c.doc_no=a.doc_no
		left join db_cashheader d on d.apinvoice_id=a.ref_no
		inner join db_bank e on e.bank_id=d.bankacc
		inner join db_coa f on e.bank_coa=f.acc_no
		inner join db_subproject g on c.project_no = g.subproject_id
		where e.bank_id = @bank and d.trx_type='BK' and d.payment_date between @startdate and @enddate and g.id_pt = @pt order by d.payment_date
		end
	END
	ELSE
	BEGIN
		if(@bank = 0)
		begin
		select voucher,convert(varchar(12), d.payment_date, 113) as trans_date, convert(varchar(12), a.doc_date, 113) as doc_date, 
		nm_supplier,d.descs, a.doc_no, d.amount, f.acc_name as bank_nm, d.paidby from db_apledger a
		inner join pemasok b on b.kd_supp_gb=a.vendor_acct	
		inner join db_apinvoice c on c.doc_no=a.doc_no
		left join db_cashheader d on d.apinvoice_id=a.ref_no
		inner join db_bank e on e.bank_id=d.bankacc
		inner join db_coa f on e.bank_coa=f.acc_no
		inner join db_subproject g on c.project_no = g.subproject_id
		where d.trx_type='BK' and d.payment_date between @startdate and @enddate and g.id_pt = @pt order by d.payment_date
		end
		else
		begin
		select voucher,convert(varchar(12), d.payment_date, 113) as trans_date, convert(varchar(12), a.doc_date, 113) as doc_date, 
		nm_supplier,d.descs, a.doc_no, d.amount, f.acc_name as bank_nm, d.paidby from db_apledger a
		inner join pemasok b on b.kd_supp_gb=a.vendor_acct	
		inner join db_apinvoice c on c.doc_no=a.doc_no
		left join db_cashheader d on d.apinvoice_id=a.ref_no
		inner join db_bank e on e.bank_id=d.bankacc
		inner join db_coa f on e.bank_coa=f.acc_no
		inner join db_subproject g on c.project_no = g.subproject_id
		where e.bank_id = @bank and d.trx_type='BK' and d.payment_date between @startdate and @enddate and g.id_pt = @pt order by d.payment_date
		end
	END
END
ELSE
BEGIN
	IF @project_detail=0
	BEGIN
		if(@bank = 0)
		begin
		select voucher,convert(varchar(12), d.payment_date, 113) as trans_date, convert(varchar(12), a.doc_date, 113) as doc_date, 
		nm_supplier,d.descs, a.doc_no, d.amount, f.acc_name as bank_nm, d.paidby from db_apledger a
		inner join pemasok b on b.kd_supp_gb=a.vendor_acct	
		inner join db_apinvoice c on c.doc_no=a.doc_no
		left join db_cashheader d on d.apinvoice_id=a.ref_no
		inner join db_bank e on e.bank_id=d.bankacc
		inner join db_coa f on e.bank_coa=f.acc_no
		inner join db_subproject g on c.project_no = g.subproject_id
		where d.trx_type='BK' and d.payment_date between @startdate and @enddate and a.vendor_acct=@vendor and g.id_pt = @pt order by d.payment_date
		end
		else
		begin
		select voucher,convert(varchar(12), d.payment_date, 113) as trans_date, convert(varchar(12), a.doc_date, 113) as doc_date, 
		nm_supplier,d.descs, a.doc_no, d.amount, f.acc_name as bank_nm, d.paidby from db_apledger a
		inner join pemasok b on b.kd_supp_gb=a.vendor_acct	
		inner join db_apinvoice c on c.doc_no=a.doc_no
		left join db_cashheader d on d.apinvoice_id=a.ref_no
		inner join db_bank e on e.bank_id=d.bankacc
		inner join db_coa f on e.bank_coa=f.acc_no
		inner join db_subproject g on c.project_no = g.subproject_id
		where e.bank_id = @bank and d.trx_type='BK' and d.payment_date between @startdate and @enddate and a.vendor_acct=@vendor and g.id_pt = @pt order by d.payment_date
		end
	END
	ELSE
	BEGIN
		if(@bank = 0)
		begin
		select voucher,convert(varchar(12), d.payment_date, 113) as trans_date, convert(varchar(12), a.doc_date, 113) as doc_date, 
		nm_supplier,d.descs, a.doc_no, d.amount, f.acc_name as bank_nm, d.paidby from db_apledger a
		inner join pemasok b on b.kd_supp_gb=a.vendor_acct	
		inner join db_apinvoice c on c.doc_no=a.doc_no
		left join db_cashheader d on d.apinvoice_id=a.ref_no
		inner join db_bank e on e.bank_id=d.bankacc
		inner join db_coa f on e.bank_coa=f.acc_no
		inner join db_subproject g on c.project_no = g.subproject_id
		where d.trx_type='BK' and d.payment_date between @startdate and @enddate and a.vendor_acct=@vendor and g.id_pt = @pt order by d.payment_date
		end
		else
		begin
		select voucher,convert(varchar(12), d.payment_date, 113) as trans_date, convert(varchar(12), a.doc_date, 113) as doc_date, 
		nm_supplier,d.descs, a.doc_no, d.amount, f.acc_name as bank_nm, d.paidby from db_apledger a
		inner join pemasok b on b.kd_supp_gb=a.vendor_acct	
		inner join db_apinvoice c on c.doc_no=a.doc_no
		left join db_cashheader d on d.apinvoice_id=a.ref_no
		inner join db_bank e on e.bank_id=d.bankacc
		inner join db_coa f on e.bank_coa=f.acc_no
		inner join db_subproject g on c.project_no = g.subproject_id
		where e.bank_id = @bank and d.trx_type='BK' and d.payment_date between @startdate and @enddate and a.vendor_acct=@vendor and g.id_pt = @pt order by d.payment_date
		end
	END
END
















