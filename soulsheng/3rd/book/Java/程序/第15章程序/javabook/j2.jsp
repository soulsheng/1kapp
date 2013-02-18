<HTML>
<BODY>
	<%@ page language="java" %> 
	<%!String name="";%> 
	<% name = request.getParameter("thename");session.putValue("thename", name);%>
    您的姓名是:<%=name%> 
    <P><FORM METHOD=POST ACTION="j3.jsp">
    您喜欢吃什么 ? 
    <INPUT TYPE=TEXT NAME="food"><P> 
    <INPUT TYPE=SUBMIT VALUE="SUBMIT"> 
    </FORM>
</BODY>
</HTML>