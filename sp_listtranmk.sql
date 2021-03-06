USE [BSUALL2005trial]
GO
/****** Object:  StoredProcedure [dbo].[sp_listtranmk]    Script Date: 2/17/2015 7:23:21 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO




ALTER proc [dbo].[sp_listtranmk]
@trx varchar(5),
@project_detail varchar(5),
@startdate datetime,
@enddate datetime,
@bank int
 as


 --exec sp_listtranmk 'BK','11202','01-01-2015','17-02-2015',0


IF (@trx = 'BM')
	BEGIN
		IF @project_detail=0
		BEGIN
		if(@bank = 0)
		begin
		select a.trx_type,c.acc_name,voucher, trans_date, '-' as nm_supplier, descs, paidby, a.status, slipno, bank_nm, amount, payment_date from db_cashheader a
		--join db_cashdetail b on b.project_cd = a.project_cd and a.voucher=b.voucher
		left join db_bank b on b.bank_id = a.bankacc
		left join db_coa c on c.acc_no = b.bank_coa
		--left join pemasok on kd_supp_gb=vendor_acct
		where a.trx_type = 'BM' and a.trans_date >= @startdate and a.trans_date <= @enddate --and pemasok.kd_project in ('41011','41012','1')
		end
		else
		begin
		select c.acc_name,voucher, trans_date, '-' as nm_supplier, descs, paidby, a.status, slipno, bank_nm, amount, payment_date from db_cashheader a
		--join db_cashdetail b on b.project_cd = a.project_cd and a.voucher=b.voucher
		left join db_bank b on b.bank_id = a.bankacc
		left join db_coa c on c.acc_no = b.bank_coa
		--left join pemasok on kd_supp_gb=vendor_acct
		where b.bank_id = @bank and a.trx_type = 'BM' and a.trans_date >= @startdate and a.trans_date <= @enddate --and pemasok.kd_project in ('41011','41012','1')
		end
		END
		ELSE
		BEGIN
		if(@bank = 0)
		begin
		select c.acc_name,voucher, trans_date, '-' as nm_supplier, descs, paidby, a.status, slipno, bank_nm, amount, payment_date from db_cashheader a
		--join db_cashdetail b on b.project_cd = a.project_cd and a.voucher=b.voucher
		left join db_bank b on b.bank_id = a.bankacc
		left join db_coa c on c.acc_no = b.bank_coa
		--left join pemasok on kd_supp_gb=vendor_acct
		where a.trx_type = 'BM' and a.trans_date >= @startdate and a.trans_date <= @enddate and a.project_cd=@project_detail
		end
		else
		begin
		select c.acc_name,voucher, trans_date, '-' as nm_supplier, descs, paidby, a.status, slipno, bank_nm, amount, payment_date from db_cashheader a
		--join db_cashdetail b on b.project_cd = a.project_cd and a.voucher=b.voucher
		left join db_bank b on b.bank_id = a.bankacc
		left join db_coa c on c.acc_no = b.bank_coa
		--left join pemasok on kd_supp_gb=vendor_acct
		where b.bank_id = @bank and a.trx_type = 'BM' and a.trans_date >= @startdate and a.trans_date <= @enddate and a.project_cd=@project_detail
		end
		END
	END

ELSE IF (@trx = 'BK')
	BEGIN
		IF @project_detail=0
		BEGIN
		select voucher,trans_date,nm_supplier,descs,[from],paidby,a.status,slipno,slip_date,acc_name,amount,payment_date from db_cashheader a
		--join db_cashdetail b on b.project_cd = a.project_cd and a.voucher=b.voucher
		join db_bank on bank_id = bankacc
		left join db_coa on acc_no = bank_coa
		left join pemasokMaster on kd_supp_gb=vendor_acct
		where a.trx_type = @trx and a.trans_date >= @startdate and a.trans_date <= @enddate and db_bank.bank_id = @bank--and pemasok.kd_project in ('41011','41012','1')
		ORDER BY a.trans_date ASC
		END
		ELSE
		
		if(@bank = 0)
			begin
			select voucher,trans_date,nm_supplier,descs,[from],paidby,a.status,slipno,slip_date,acc_name,amount,payment_date from db_cashheader a
			--join db_cashdetail b on b.project_cd = a.project_cd and a.voucher=b.voucher
			join db_bank on bank_id = bankacc
			left join db_coa on acc_no = bank_coa
			left join pemasokMaster on kd_supp_gb=vendor_acct
			where a.trx_type = 'BK' and a.trans_date >= @startdate and a.trans_date <= @enddate and a.project_cd=@project_detail
			ORDER BY a.trans_date ASC
			end
		
		ELSE
		BEGIN
		select voucher,trans_date,nm_supplier,descs,[from],paidby,a.status,slipno,slip_date,acc_name,amount,payment_date from db_cashheader a
		--join db_cashdetail b on b.project_cd = a.project_cd and a.voucher=b.voucher
		join db_bank on bank_id = bankacc
		left join db_coa on acc_no = bank_coa
		left join pemasokMaster on kd_supp_gb=vendor_acct
		where a.trx_type = 'BK' and a.trans_date >= @startdate and a.trans_date <= @enddate and a.project_cd=@project_detail and db_bank.bank_id = @bank --and pemasok.kd_project in ('41011','41012','1')
		ORDER BY a.trans_date ASC
		END
	END


	--select * from db_cashheader

	--sp_help db_cashheader