<HTML>
<BODY>
	<%@ page language="java" %> 
	<%!String name="";%> 
	<% name = request.getParameter("thename");session.putValue("thename", name);%>
    ����������:<%=name%> 
    <P><FORM METHOD=POST ACTION="j3.jsp">
    ��ϲ����ʲô ? 
    <INPUT TYPE=TEXT NAME="food"><P> 
    <INPUT TYPE=SUBMIT VALUE="SUBMIT"> 
    </FORM>
</BODY>
</HTML>