USE [BSUALL2005trial]
GO
/****** Object:  StoredProcedure [dbo].[sp_EditBK2]    Script Date: 2/11/2015 10:32:00 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

ALTER PROCEDURE [dbo].[sp_EditBK2]
@voucher varchar(20),
@nocek varchar (20),
@cek_date datetime,
@payment_date datetime,
@paid_date datetime,
@no_asip varchar(100)

AS
if(@paid_date = '1970-01-01')
begin
UPDATE DB_CASHHEADER SET payment_date=@payment_date,slip_date = @cek_date,no_arsip = @no_asip, STATUS=5, slipno=@nocek where voucher=@voucher
end
else
begin
UPDATE DB_CASHHEADER SET payment_date=@payment_date,slip_date = @cek_date,no_arsip = @no_asip, STATUS=3, slipno=@nocek, paid_date = @paid_date  where voucher=@voucher
end

Declare @total numeric(18,2), @balance numeric(18,2), @ref_no varchar(100)

		select @total=mbase_amt from db_apledger where ref_no=@ref_no
		select @balance=sum(amount) from db_cashheader where refno=@ref_no

		--IF @total=@balance 
		--BEGIN
		--Update db_apinvoice set status=5 where apinvoice_id=@ref_no
		--END
