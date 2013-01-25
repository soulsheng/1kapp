package test;
import java.io.*;
import javax.servlet.*;
import javax.servlet.http.*;
import java.util.*;
public class ShowCGIVariables extends HttpServlet {
	public void doGet(HttpServletRequest request,HttpServletResponse response)
		throws ServletException, IOException {
		response.setContentType("text/html");
		PrintWriter out = response.getWriter();
		String[][] variables ={ { "AUTH_TYPE", request.getAuthType() },
		{ "CONTENT_LENGTH", String.valueOf(request.getContentLength()) },
		{ "CONTENT_TYPE", request.getContentType() },
		{ "DOCUMENT_ROOT", getServletContext().getRealPath("/") },
		{ "PATH_INFO", request.getPathInfo() },
		{ "PATH_TRANSLATED", request.getPathTranslated() },
		{ "QUERY_STRING", request.getQueryString() },
		{ "REMOTE_ADDR", request.getRemoteAddr() },
		{ "REMOTE_HOST", request.getRemoteHost() },
		{ "REMOTE_USER", request.getRemoteUser() },
		{ "REQUEST_METHOD", request.getMethod() },
		{ "SCRIPT_NAME", request.getServletPath() },
		{ "SERVER_NAME", request.getServerName() },
		{ "SERVER_PORT", String.valueOf(request.getServerPort()) },
		{ "SERVER_PROTOCOL", request.getProtocol() },
		{ "SERVER_SOFTWARE", getServletContext().getServerInfo() }};
		String title = "œ‘ æCGI±‰¡ø";
		out.println(ServletUtilities.headWithTitle(title) +"<BODY BGCOLOR=\"#FDF5E6\">\n"
		 +"<H1 ALIGN=CENTER>" + title + "</H1>\n" +"<TABLE BORDER=1 ALIGN=CENTER>\n"
		  +"<TR BGCOLOR=\"#FFAD00\">\n" +"<TH>CGI Variable Name<TH>Value");
		for(int i=0; i<variables.length; i++){
		  	String varName = variables[i][0];
			String varValue = variables[i][1];
			if (varValue == null)
				varValue = "<I>Not specified</I>";
			out.println("<TR><TD>" + varName + "<TD>" + varValue);
		}
		out.println("</TABLE></BODY></HTML>");
	}
	public void doPost(HttpServletRequest request,HttpServletResponse response)
		throws ServletException, IOException {
		doGet(request, response);
	}
}