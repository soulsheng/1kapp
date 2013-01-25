<HTML>
<BODY>
	<%@ page language="java"%>
	<%!String food="";%>
	<% food = request.getParameter("food");String name = (String) session.getValue("thename");%>
	ÄúµÄÐÕÃûÊÇ£º<%=name%>
	<P>
	ÄúÏ²»¶³Ô£º<%=food%>
</BODY>
</HTML>

