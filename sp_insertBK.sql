USE [BSUALL2005trial]
GO
/****** Object:  StoredProcedure [dbo].[sp_InsertBK]    Script Date: 2/7/2015 12:59:41 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
ALTER PROCEDURE [dbo].[sp_InsertBK]
@idcash int,
@proj varchar(10),
@trx_type varchar(2),
@input_user varchar(15),
@voucher varchar(20),
@bank varchar(10),
@tgl datetime,
@paid varchar(15),
--@from varchar(20),
@apno varchar(20),
--@no_cek varchar(20),
--@cek_date datetime,
--@paid_date datetime,
@amount numeric(18, 2),
@remark varchar(250),
@memo varchar(40)
--@voucher varchar(20) = '' OUTPUT

AS
--SET @voucher = ''
DECLARE @vendor varchar(20), @id_ap int, @doc_no varchar(20), @project_detail varchar(5)


--BEGIN
--select*from DB_CASHHEADER

	
--SET @voucher = dbo.[GetNoCashHeader] (@trx_type,@tgl)
	SELECT @id_ap =id_ap from db_cashplan where id_plan=@apno
	SELECT @vendor=vendor_acct, @project_detail=project_no from db_apinvoice where apinvoice_id=@id_ap
--select*from db_apinvoice
	--BEGIN TRAN
		--BEGIN
			--update DB_CASHHEADER (project_cd, trx_type, 
			--voucher, module, trans_date, descs, paidby, currency, amount, rate, base_amount,amt_balance,
			--vendor_acct, refno, bankacc,payment_date, cash_in, status, user_, datetime, apinvoice_id, pph)
			--VALUES(@project_detail, 'BK', 
			--@voucher, 'CB', @tgl, @remark, @paid, 1, @Amount, 1, @Amount,0, @vendor, @apno, @bank,'',@kodecash,0,@input_user,getdate(), @id_ap,0)
			update DB_CASHHEADER set
			project_cd = @project_detail,trx_type = 'BK',voucher = @voucher,module = 'CB',trans_date = @tgl,
			descs = @remark,paidby = @paid,currency = '1',amount = @Amount,rate = '1',base_amount = @Amount,
			amt_balance = '0',vendor_acct = @vendor,refno = @apno,bankacc = @bank,payment_date = '',
			[status] = '0',user_ = @input_user,[datetime] = getdate(),apinvoice_id = @id_ap,pph = '0'
			where id_cash = @idcash		
			

			DECLARE @ID_CASH INT
			SELECT @ID_CASH=ID_CASH FROM DB_CASHHEADER WHERE VOUCHER=@VOUCHER
			UPDATE DB_CASHPLAN SET ID_CASH=@ID_CASH  WHERE ID_PLAN=@apno

			Declare @total numeric(18,2), @balance numeric(18,2)

			--select @total=mbase_amt from db_apledger where ref_no=@id_ap
			select @total=base_amt from db_apinvoice where apinvoice_id=@id_ap
			select @balance=sum(amount) from db_cashheader where apinvoice_id=@id_ap

			IF @total=@balance
			BEGIN
			Update db_apinvoice set status=3 where apinvoice_id=@id_ap
			END

			Declare @pph int

			SELECT @doc_no=doc_no from db_apinvoice where apinvoice_id=@id_ap

			SELECT @pph=pph from DB_APINVOICEDET where doc_no=@doc_no

			IF @Amount=@pph
			BEGIN
			Update db_cashheader set pph=1 where id_cash=@ID_CASH
			END