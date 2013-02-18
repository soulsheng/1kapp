package test;
import java.io.*;
import javax.servlet.*;
import javax.servlet.http.*;
import java.net.*;
public class SearchEngines extends HttpServlet {
	public void doGet(HttpServletRequest request,HttpServletResponse response)
		throws ServletException, IOException {
	// getParameter自动解码URL编码的查询字符串。由于我们
	// 要把查询字符串发送给另一个服务器，因此再次使用URLEncoder进行URL编码
		String searchString =URLEncoder.encode(request.getParameter("searchString"));
		String numResults =request.getParameter("numResults");
		String searchEngine =request.getParameter("searchEngine");
		SearchSpec[] commonSpecs = SearchSpec.getCommonSpecs();
		for(int i=0; i<commonSpecs.length; i++){
			SearchSpec searchSpec = commonSpecs[i];
			if (searchSpec.getName().equals(searchEngine)) {
				String url =response.encodeURL(searchSpec.makeURL(searchString,numResults));
				response.sendRedirect(url);
				return;
			}
		}
		response.sendError(response.SC_NOT_FOUND,"No recognized search engine specified.");
	}
	public void doPost(HttpServletRequest request,HttpServletResponse response)
		throws ServletException, IOException {
		doGet(request, response);
	}
}

