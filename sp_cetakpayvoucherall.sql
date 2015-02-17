USE [BSUALL2005trial]
GO
<<<<<<< HEAD
/****** Object:  StoredProcedure [dbo].[sp_cetakpayvoucherall]    Script Date: 2/17/2015 5:57:45 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
ALTER PROCEDURE [dbo].[sp_cetakpayvoucherall]
=======

/****** Object:  StoredProcedure [dbo].[sp_cetakpayvoucherall]    Script Date: 2/17/2015 4:06:29 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[sp_cetakpayvoucherall]
>>>>>>> 2dda4bcc12bfae949bf0e431cb7e40c2bbe76fd7
@id varchar(5)


AS

<<<<<<< HEAD
SELECT doc_no, inv_no, inv_date,doc_date, base_amt, due_date, convert(numeric (18,0),trx_amt) as trx_amt, descs, npwp, nm_supplier, (alamat +' '+kota) as alamat from db_apinvoice 
	inner join pemasok on pemasok.kd_supp_gb=db_apinvoice.vendor_acct
	where apinvoice_id=@id --and kd_project in ('41012','41011','1','41013')

--select*from db_apinvoice
=======
SELECT doc_no, inv_no,inv_date, doc_date, due_date, convert(numeric (18,0),trx_amt) as trx_amt ,convert(numeric (18,0),base_amt) as base_amt, descs, npwp, nm_supplier, (alamat +' '+kota) as alamat from db_apinvoice 
	inner join pemasok on pemasok.kd_supp_gb=db_apinvoice.vendor_acct
	where apinvoice_id=@id --and kd_project in ('41012','41011','1','41013')

--select*from db_apinvoice



--select * from db_trbgtdiv order by id_trbgt desc
GO


>>>>>>> 2dda4bcc12bfae949bf0e431cb7e40c2bbe76fd7
