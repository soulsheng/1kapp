<%@ page contentType="text/html; charset=gb2312" %>
<%@ page language="java" import="java.sql.*" %>
<html>
<head>
<title>
���������ѯ���
</title>
</head>
<jsp:useBean id="sqlID" scope="session" class="webretail.sqlBean" />
<body bgcolor="#ffffff">
<h1>���������ѯ���</h1>
<%! String wareID;%>
<% wareID=request.getParameter("Wares_ID");%>
<%! ResultSet rst; %>
<% rst=sqlID.execQuery("Select * from stocking_table where wares_ID='"+wareID+"'");%>
<%! int col,i;%>
<%
  col=rst.getMetaData().getColumnCount(); %>
<table  border="1" >
<th>��Ʒ����</th>
<th>��Ʒ����</th>
<th>��������</th>
<th>���ۼ۸�</th>
<th>���۵�λ</th>
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
</h2><a href="index.htm">�ص���ҳ</h2>

</body>
</html>
