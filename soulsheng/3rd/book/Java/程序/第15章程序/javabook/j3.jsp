<HTML>
<BODY>
	<%@ page language="java"%>
	<%!String food="";%>
	<% food = request.getParameter("food");String name = (String) session.getValue("thename");%>
	���������ǣ�<%=name%>
	<P>
	��ϲ���ԣ�<%=food%>
</BODY>
</HTML>

