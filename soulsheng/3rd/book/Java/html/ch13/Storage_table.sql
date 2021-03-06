if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[storage_table]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[storage_table]
GO

CREATE TABLE [dbo].[storage_table] (
	[wares_id] [varchar] (50) COLLATE Chinese_PRC_CI_AS NULL ,
	[wares_name] [varchar] (50) COLLATE Chinese_PRC_CI_AS NULL ,
	[s_amount] [int] NULL ,
	[units] [varchar] (50) COLLATE Chinese_PRC_CI_AS NULL ,
	[s_date] [datetime] NULL 
) ON [PRIMARY]
GO

