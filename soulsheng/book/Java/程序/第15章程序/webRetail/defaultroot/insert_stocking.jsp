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
   wareunit=request.getParameter("Wares_Unit");
   amount=Integer.valueOf(request.getParameter("Wares_Amount")).intValue();;
   price=Float.valueOf(request.getParameter("Wares_Price")).floatValue();
     waredate=request.getParameter("Wares_Date");
  sqlID.execUpdate("insert into stocking_table values ('"+
   wareId+"','"+warename+"',"+amount+","+price+",'"+wareunit+"','"+
   waredate+"')");%>
<h2><a href="index.htm">回到首页</h2>
</body>
</html>
