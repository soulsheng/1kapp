package test;
import java.io.*;//使用PrintWriter等类
import javax.servlet.*;//使用HttpServlet等类
import javax.servlet.http.*;//使用HttpServletRequest和HttpServletResponse
public class HelloWorld extends HttpServlet{
	public void doGet(HttpServletRequest request,HttpServletResponse response)						throws ServletException, IOException {
		PrintWriter out = response.getWriter();
		out.println("<html>");
		out.println("<head><title> Servlet </title></head>");
		out.println("<body>");
		out.println("Hello World");
		out.println("</body></html>");
		out.close();
	}
}