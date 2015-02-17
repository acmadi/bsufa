USE [BSUALL2005trial]
GO
/****** Object:  StoredProcedure [dbo].[sp_cetakpayvoucherall]    Script Date: 2/17/2015 5:57:45 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
ALTER PROCEDURE [dbo].[sp_cetakpayvoucherall]
@id varchar(5)


AS

SELECT doc_no, inv_no, inv_date,doc_date, base_amt, due_date, convert(numeric (18,0),trx_amt) as trx_amt, descs, npwp, nm_supplier, (alamat +' '+kota) as alamat from db_apinvoice 
	inner join pemasok on pemasok.kd_supp_gb=db_apinvoice.vendor_acct
	where apinvoice_id=@id --and kd_project in ('41012','41011','1','41013')

--select*from db_apinvoice