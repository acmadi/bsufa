USE [BSUALL2005trial]
GO
/****** Object:  StoredProcedure [dbo].[sp_cetakcbvoucherall]    Script Date: 2/17/2015 5:58:58 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


ALTER PROCEDURE [dbo].[sp_cetakcbvoucherall]
@id int

AS

DECLARE @id_cash int

select @id_cash=id_cash from db_cashplan where id_plan=@id


--SELECT acc_name as bank_nm, voucher as doc_no, doc_no as inv_no, trans_date as doc_date, b.doc_date as due_date, convert(numeric (18,0),amount) as trx_amt, 
--a.descs, nm_supplier, (alamat +' '+kota) as alamat, slipno from db_cashheader a
--inner join db_apinvoice b on a.apinvoice_id=b.apinvoice_id
--inner join pemasok c on c.kd_supplier=b.vendor_acct
--inner join db_bank d on a.bankacc=d.bank_id
--inner join db_coa e on d.bank_coa=e.acc_no
--where voucher=(SELECT voucher from db_cashheader where id_cash=1501) 

select d.bank_nm,a.voucher as doc_no,b.doc_no as inv_no,a.trans_date as doc_date,b.doc_date as due_date,
a.amount as trx_amt,a.descs,f.nm_supplier,f.alamat,a.slipno 
from db_cashheader a
join db_apinvoice b on a.apinvoice_id = b.apinvoice_id 
join db_cashplan c on c.id_ap = b.apinvoice_id 
join db_bank d on d.bank_id = a.bankacc 
--join db_apinvoiceoth e on e.doc_no = b.doc_no 
join pemasokmaster f on f.kd_supp_gb = b.vendor_acct 
where c.id_plan = @id
--select*from pemasokmaster
--select*from db_cashplan
	















