<%@ page contentType="text/html; charset=GBK" %>
<%@ page language="java" import="java.sql.*" %>
<html>
<head>
<title>
进货情况查询结果
</title>
</head>
<jsp:useBean id="sqlID" scope="session" class="webretail.sqlBean" />
<body bgcolor="#ffffff">
<h1>商品库存情况查询</h1>
<%! String wareID;%>
<% wareID=request.getParameter("Wares_ID");%>
<%! ResultSet rst; %>
<% rst=sqlID.execQuery("Select * from storage_table where wares_ID='"+wareID+"'");%>
<%! int col,i;%>
<%
  col=rst.getMetaData().getColumnCount(); %>
<table  border="1" >
<th>商品代码</th>
<th>商品名称</th>
<th>库存数量</th>
<th>包装单位</th>
<th>盘点日期</th>
<% while(rst.next()){%>
<tr>
<%for(i=1;i<=col;i++){%>
<td>
<%=rst.getString(i)%>
</td>
<%}%>
</tr>
<%}%>
</table>
</h2><a href="index.htm">回到首页</h2>
</body>
</html>
