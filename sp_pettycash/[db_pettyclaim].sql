--USE [new_sinkalmarlarnd]
GO

/****** Object:  Table [dbo].[db_pettyclaim]    Script Date: 2/6/2015 10:52:23 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[db_pettyclaim](
	[pettycash_id] [int] IDENTITY(1,1) NOT FOR REPLICATION NOT NULL,
	[Type] [varchar](1) NULL,
	[claim_no] [char](20) NOT NULL,
	[acc_no] [char](20) NOT NULL,
	[acc_curr] [char](3) NULL,
	[acc_name] [char](40) NULL,
	[claim_date] [datetime] NULL,
	[saldo] [numeric](14, 2) NULL,
	[rate] [numeric](8, 4) NULL,
	[debet] [numeric](14, 2) NULL,
	[credit] [numeric](14, 2) NULL,
	[petty_desc] [text] NULL,
	[status] [numeric](1, 0) NULL,
	[user_] [char](30) NULL,
	[datetime] [datetime] NULL,
	[status_reimburse] [numeric](1, 0) NULL,
	[sub_claim_no] [varchar](100) NULL
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO


