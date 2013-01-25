package test;
import java.io.*;
import javax.servlet.*;
import javax.servlet.http.*;
import java.util.*;
public class ShowParameters extends HttpServlet {
	public void doGet(HttpServletRequest request,HttpServletResponse response)
		throws ServletException, IOException {
		response.setContentType("text/html");
		PrintWriter out=response.getWriter();
		String title ="读取所有请求参数";
		out.println(ServletUtilities.headWithTitle(title) +"<BODY BGCOLOR=\"#FDF5E6\">\n"
		+"<H1 ALIGN=CENTER>"+title+"</H1>\n" +"<TABLE BORDER=1 ALIGN=CENTER>\n"
		+"<TR BGCOLOR=\"#FFAD00\">\n"+"<TH>参数名字<TH>参数值");
		Enumeration paramNames=request.getParameterNames();
		while(paramNames.hasMoreElements()){
			String paramName=(String)paramNames.nextElement();
			out.println("<TR><TD>"+paramName+"\n<TD>");
			String[] paramValues=request.getParameterValues(paramName);
			if (paramValues.length==1){
				String paramValue=paramValues[0];
				if (paramValue.length()==0)
					out.print("<I>No Value</I>");
				else
					out.print(paramValue);
			}else{
				out.println("<UL>");
				for(int i=0;i<paramValues.length;i++){
					out.println("<LI>"+paramValues[i]);
				}
				out.println("</UL>");
			}
		}
		out.println("</TABLE>\n</BODY></HTML>");
	}
	public void doPost(HttpServletRequest request,HttpServletResponse response)
		throws ServletException,IOException{
		doGet(request,response);
	}
}