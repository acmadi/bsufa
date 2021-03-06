USE [BSUALL2005trial]
GO
/****** Object:  StoredProcedure [dbo].[sp_OutVoucher]    Script Date: 2/10/2015 6:17:44 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO



ALTER proc [dbo].[sp_OutVoucher]
@tgl datetime,
@project_detail varchar(5),
@bank int
 as


IF @project_detail=0
BEGIN
	if(@bank = 0)
	begin
	
	select convert(varchar(12), a.doc_date, 113) as doc_date, c.nm_supplier, a.descs, a.inv_no, a.inv_date,
	b.payment_date, b.base_amount as mdoc_amt, convert(varchar(12), a.due_date, 113) as due_date,
	DATEDIFF(d,a.due_date,getdate()) as days
	from db_apinvoice a
	left join db_cashheader b on a.apinvoice_id = b.apinvoice_id
	left join PemasokMaster c on c.kd_supp_gb = a.vendor_acct
	where b.base_amount is not null and a.due_date<=@tgl order by a.doc_date
	-- and b.kd_project in ('41011','41012','1','41013')
	end
	else
	begin
	
	select convert(varchar(12), a.doc_date, 113) as doc_date, c.nm_supplier, a.descs, a.inv_no, a.inv_date,
	b.payment_date, b.base_amount as mdoc_amt, convert(varchar(12), a.due_date, 113) as due_date,
	DATEDIFF(d,a.due_date,getdate()) as days
	from db_apinvoice a
	left join db_cashheader b on a.apinvoice_id = b.apinvoice_id
	left join PemasokMaster c on c.kd_supp_gb = a.vendor_acct
	where b.base_amount is not null and a.due_date<=@tgl and b.bankacc = @bank order by a.doc_date
	end
END
ELSE
BEGIN
	if(@bank = 0)
	begin
	
	select convert(varchar(12), a.doc_date, 113) as doc_date, c.nm_supplier, a.descs, a.inv_no, a.inv_date,
	b.payment_date, b.base_amount as mdoc_amt, convert(varchar(12), a.due_date, 113) as due_date,
	DATEDIFF(d,a.due_date,getdate()) as days
	from db_apinvoice a
	left join db_cashheader b on a.apinvoice_id = b.apinvoice_id
	left join PemasokMaster c on c.kd_supp_gb = a.vendor_acct
	where b.base_amount is not null and a.due_date<=@tgl and a.project_no =@project_detail order by a.doc_date
	
	
	end
	else
	begin
	
	select convert(varchar(12), a.doc_date, 113) as doc_date, c.nm_supplier, a.descs, a.inv_no, a.inv_date,
	b.payment_date, b.base_amount as mdoc_amt, convert(varchar(12), a.due_date, 113) as due_date,
	DATEDIFF(d,a.due_date,getdate()) as days
	from db_apinvoice a
	left join db_cashheader b on a.apinvoice_id = b.apinvoice_id
	left join PemasokMaster c on c.kd_supp_gb = a.vendor_acct
	where b.base_amount is not null and a.due_date<=@tgl and a.project_no =@project_detail and b.bankacc = @bank order by a.doc_date
	end
END

















