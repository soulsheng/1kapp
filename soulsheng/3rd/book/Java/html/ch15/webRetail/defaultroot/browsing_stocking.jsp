<%@ page contentType="text/html; charset=GBK" %>
<%@ page language="java" import="java.sql.*" %>
<html>
<head>
<title>
SqlDB
</title>
</head>
<jsp:useBean id="sqlDBId" scope="session" class="webretail.sqlBean" />
<body bgcolor="#ffffff">
<h1>�����������</h1>
<%! ResultSet rst; %>
<% rst=sqlDBId.execQuery("Select * from stocking_table"); %>
<%! int col,i;%>
<%
  col=rst.getMetaData().getColumnCount(); %>
<table  border="1" >
<th>��Ʒ����</th>
<th>��Ʒ����</th>
<th>��������</th>
<th>�����۸�</th>
<th>��װ��λ</th>

<th>��������</th>
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
<h2><a href="index.htm">�ص���ҳ</h2>
</body>
</html>
