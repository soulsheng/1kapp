package test;
import java.io.*;//ʹ��PrintWriter����
import javax.servlet.*;//ʹ��HttpServlet����
import javax.servlet.http.*;//ʹ��HttpServletRequest��HttpServletResponse
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