<%@ page contentType="text/html; charset=gb2312" %>
<html>
<head>
<title>
Insert_stocking
</title>
</head>
<jsp:useBean id="sqlID" scope="session" class="webretail.sqlBean" />
<body bgcolor="#ffffff">
<h1>成功插入新记录</h1>
<%! String wareId,warename,wareunit,waredate;%>
<%! int amount;%>
<%! float price;%>
<% wareId=request.getParameter("Wares_ID");
   warename=request.getParameter("Wares_Name");
   amount=Integer.valueOf(request.getParameter("Wares_Amount")).intValue();;
   wareunit=request.getParameter("Wares_Unit");
   waredate=request.getParameter("Wares_Date");
  sqlID.execUpdate("insert into storage_table values ('"+
   wareId+"','"+warename+"',"+amount+",'"+wareunit+"','"+
   waredate+"')");%>
</body>
<h2><a href="index.htm">回到首页</h2>
</html>

