<HTML>
<HEAD><TITLE>JSP页面</TITLE></HEAD>
<BODY>
	<%@ page language="java"%>
	<%! String str="0";%>
	<% for (int i=1;i<10;i++){ str = str + i;} %>
	JSP 输出之前。
	<P><%= str %><P>
	JSP 输出之后。
</BODY>
</HTML>