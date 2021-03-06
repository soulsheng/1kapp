if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[sales_table]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[sales_table]
GO

CREATE TABLE [dbo].[sales_table] (
	[Wares_ID] [varchar] (50) COLLATE Chinese_PRC_CI_AS NULL ,
	[Wares_name] [varchar] (50) COLLATE Chinese_PRC_CI_AS NULL ,
	[O_amount] [int] NULL ,
	[O_price] [float] NULL ,
	[Units] [char] (10) COLLATE Chinese_PRC_CI_AS NULL ,
	[O_Date] [datetime] NULL 
) ON [PRIMARY]
GO

