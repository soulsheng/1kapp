if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[stocking_table]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[stocking_table]
GO

CREATE TABLE [dbo].[stocking_table] (
	[Wares_ID] [varchar] (50) COLLATE Chinese_PRC_CI_AS NULL ,
	[Wares_name] [varchar] (50) COLLATE Chinese_PRC_CI_AS NULL ,
	[I_amount] [int] NULL ,
	[I_price] [float] NULL ,
	[Units] [char] (10) COLLATE Chinese_PRC_CI_AS NULL ,
	[I_Date] [datetime] NULL 
) ON [PRIMARY]
GO

