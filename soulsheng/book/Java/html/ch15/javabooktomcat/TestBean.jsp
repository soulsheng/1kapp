<%@ page import="test.TestBean" %>  
<html>
<body>
<center> 
<% TestBean testBean=new TestBean("This is a test java bean");%>
 	Java bean name is: 
<%=testBean.getName()%>
</center>
</body>
</html> 
