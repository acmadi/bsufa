USE [BSUALL2005trial]
GO
/****** Object:  StoredProcedure [dbo].[sp_Insertapinvoice_opepro]    Script Date: 2/9/2015 8:48:29 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
ALTER PROCEDURE [dbo].[sp_Insertapinvoice_opepro]
@nett numeric(18,2),
@flagap varchar(50),
@dpp_ppn numeric(18,2),
@dpp_pph numeric(18,2),
@ap_proj varchar(10),
@doc_no varchar(20),
@inv_no varchar(70),
@receipt_date datetime,
@inv_date datetime,
@trx_type varchar(6),
@cr_term int,
@po int,
@vendor varchar(50),
@amount numeric(18, 2),
@category varchar(20),
@ppn numeric(18, 2), -- aslinya --> @ppn varchar(2), <-- aslinya
@pph int,
@remark varchar(MAX),
@total_billing numeric(18, 2),
@paid_billing numeric(18, 2),
@balance numeric(18, 2),
@acc_dr_1  varchar(100),
@name_dr_1  varchar(100),
@acc_debet_1  numeric(18, 2),
@acc_credit_1  numeric(18, 2),
@acc_dr_2  varchar(100),
@name_dr_2  varchar(100),
@acc_debet_2  numeric(18, 2),
@acc_credit_2  numeric(18, 2),
@acc_dr_3 varchar(100),
@name_dr_3  varchar(100),
@acc_debet_3  numeric(18, 2),
@acc_credit_3  numeric(18, 2),
@acc_dr_4  varchar(100),
@name_dr_4  varchar(100),
@acc_debet_4  numeric(18, 2),
@acc_credit_4  numeric(18, 2)


AS
	DECLARE @pemasok varchar(6), @po_no varchar(40),  @kelusaha varchar(4), @categoryDescs varchar(20)

	--SET @voucher = dbo.[GetNoCashHeader] (@trx_type,@tgl)

--select*from kelusaha

			--select @pemasok=kd_supp_gb, @kelusaha=id_kelusaha From pemasokmaster where nm_supplier=@vendor
			
			--select @categoryDescs=kel_usaha from kelusaha where id_kelusaha=@kelusaha
			select @po_no=no_po From db_barangpoh where brgpoh_id=@po
						
			INSERT INTO DB_APInvoice (pphtb,flagap,dpp_ppn,dpp_pph,percent_pph,vendor_acct, project_no, 
			contract_no, trx_type, doc_no, doc_date, inv_no, inv_date, due_date, cr_term, ref_no,descs,
			trx_amt, base_amt, alloc_amt, status, pph, Currency_cd, currency_rate, audit_user, audit_date)
			VALUES(@nett/1.1*5/100,@flagap,@dpp_ppn,@dpp_pph,@pph,@vendor, @ap_proj, 
			'', @trx_type, @doc_no, @receipt_date, @inv_no, @inv_date, @inv_date, @cr_term, @po, @remark,0,@nett, 0, 0, @pph, 'IDR',1,'MGR',getdate())

			update db_apinvoice set due_date=due_date+@cr_term where doc_no=@doc_no

			INSERT INTO DB_APInvoicedet (doc_no, po_no, descs, trx_amt, ppn, pph, category, vendor_name, 
			total, paid, balance)
			VALUES(@doc_no, @po_no, '', @amount/1.1, (@amount/1.1)*0.1, (@amount/1.1*@pph)/100, @category, @vendor, 
			@total_billing, @paid_billing, @balance)


			Declare @acc_dr varchar(20), @reff_pr varchar(35), @trbgt_id varchar(5), @code_id varchar(10),
			@acc varchar(15)

			select  @acc_dr=acc_dr from pemasok
			inner join db_kelusaha on db_kelusaha.id_kelusaha=pemasok.id_kelusaha where kd_supp_gb=@pemasok
			and pemasok.kd_project not in ('41012','41011','1')

			select @reff_pr=reff_pr from db_barangpoh where brgPOH_ID=@po
			select @trbgt_id=trbgt_id from db_pr where no_pr=@reff_pr
			
			-- pengurangan budget --
			
			update db_trbgtdiv set appamount = appamount - @amount where id_trbgt = @trbgt_id
			
			select @code_id=code_id from db_trbgtdiv where id_trbgt=@trbgt_id
			select @acc=acc from db_mstbgt where code=@code_id

			INSERT INTO DB_APJURNAL (VOUCHER, ACC_NO1, ACC_NO2, ACC_NO3, ACC_NO4, DEBET, CREDIT)
			VALUES (@doc_no, @acc, @acc_dr, '1.01.05.01.08','2.01.04.03',@amount,@amount) 
			
			declare @total_invoice numeric(18,2), @total_po numeric(18,2)

			select @total_invoice = sum(trx_amt) from db_apinvoice where ref_no=@po and trx_type='PO'
			select @total_po = harga_tot From db_barangpoh where brgpoh_id=@po     

			IF @total_invoice=@total_po 
			BEGIN
			Update db_barangpoh set  islockmr=2 where  brgpoh_id=@po     
			END

			DECLARE @pph_po numeric(18,2),@debet_jurnal numeric(18,2),@credit_jurnal numeric(18,2)

			select @pph_po=pph from db_apinvoicedet where doc_no=@doc_no

			--BUAT DETAIL JURNAL DI AP
			-- ROW PERTAMA
			insert into db_apinvoiceoth (doc_no,acc_no,debet,credit,acc_name) VALUES (@doc_no,@acc_dr_1,@acc_debet_1,@acc_credit_1,@name_dr_1)
			
			-- ROW KEDUA
			insert into db_apinvoiceoth (doc_no,acc_no,debet,credit,acc_name) VALUES (@doc_no,@acc_dr_2,@acc_debet_2,@acc_credit_2,@name_dr_2)
			
			-- ROW KETIGA
			insert into db_apinvoiceoth (doc_no,acc_no,debet,credit,acc_name) VALUES (@doc_no,@acc_dr_3,@acc_debet_3,@acc_credit_3,@name_dr_3)
			
			-- ROW KEEMPAT
			insert into db_apinvoiceoth (doc_no,acc_no,debet,credit,acc_name) VALUES (@doc_no,@acc_dr_4,@acc_debet_4,@acc_credit_4,@name_dr_4)

			select @debet_jurnal=sum(debet) from db_apinvoiceoth where doc_no=@doc_no
			select @credit_jurnal=sum(credit) from db_apinvoiceoth where doc_no=@doc_no
			
			update db_apjurnal set debet=@debet_jurnal where voucher=@doc_no
			update db_apjurnal set credit=@credit_jurnal where voucher=@doc_no

