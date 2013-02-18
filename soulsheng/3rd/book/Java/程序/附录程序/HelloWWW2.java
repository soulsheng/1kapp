package test;
import java.io.*;
import javax.servlet.*;
import javax.servlet.http.*;
public class HelloWWW2 extends HttpServlet{
	public void doGet(HttpServletRequest request,HttpServletResponse response)
		throws ServletException, IOException {
		response.setContentType("text/html");
		PrintWriter out = response.getWriter();
		out.println(ServletUtilities.headWithTitle("Hello WWW") +"<BODY>\n" +
		"<H1>Hello WWW</H1>\n" +"</BODY></HTML>");
	}
}