package org.apache.jsp;

import java.sql.*;
import javax.servlet.*;
import javax.servlet.http.*;
import javax.servlet.jsp.*;
import org.apache.jasper.runtime.*;


public class browsing_0005fstocking$jsp extends HttpJspBase {

    // begin [file="/browsing_stocking.jsp";from=(8,0);to=(8,70)]
    // end
    // begin [file="/browsing_stocking.jsp";from=(11,3);to=(11,19)]
         ResultSet rst; 
    // end
    // begin [file="/browsing_stocking.jsp";from=(13,3);to=(13,14)]
         int col,i;
    // end

    static {
    }
    public browsing_0005fstocking$jsp( ) {
    }

    private static boolean _jspx_inited = false;

    public final void _jspx_init() throws org.apache.jasper.runtime.JspException {
    }

    public void _jspService(HttpServletRequest request, HttpServletResponse  response)
        throws java.io.IOException, ServletException {

        JspFactory _jspxFactory = null;
        PageContext pageContext = null;
        HttpSession session = null;
        ServletContext application = null;
        ServletConfig config = null;
        JspWriter out = null;
        Object page = this;
        String  _value = null;
        try {

            if (_jspx_inited == false) {
                synchronized (this) {
                    if (_jspx_inited == false) {
                        _jspx_init();
                        _jspx_inited = true;
                    }
                }
            }
            _jspxFactory = JspFactory.getDefaultFactory();
            response.setContentType("text/html; charset=GBK");
            pageContext = _jspxFactory.getPageContext(this, request, response,
            			"", true, 8192, true);

            application = pageContext.getServletContext();
            config = pageContext.getServletConfig();
            session = pageContext.getSession();
            out = pageContext.getOut();

            // HTML // begin [file="/browsing_stocking.jsp";from=(0,48);to=(1,0)]
                out.write("\r\n");

            // end
            // HTML // begin [file="/browsing_stocking.jsp";from=(1,47);to=(8,0)]
                out.write("\r\n<html>\r\n<head>\r\n<title>\r\nSqlDB\r\n</title>\r\n</head>\r\n");

            // end
            // begin [file="/browsing_stocking.jsp";from=(8,0);to=(8,70)]
                webretail.sqlBean sqlDBId = null;
                boolean _jspx_specialsqlDBId  = false;
                 synchronized (session) {
                    sqlDBId= (webretail.sqlBean)
                    pageContext.getAttribute("sqlDBId",PageContext.SESSION_SCOPE);
                    if ( sqlDBId == null ) {
                        _jspx_specialsqlDBId = true;
                        try {
                            sqlDBId = (webretail.sqlBean) java.beans.Beans.instantiate(this.getClass().getClassLoader(), "webretail.sqlBean");
                        } catch (ClassNotFoundException exc) {
                             throw new InstantiationException(exc.getMessage());
                        } catch (Exception exc) {
                             throw new ServletException (" Cannot create bean of class "+"webretail.sqlBean", exc);
                        }
                        pageContext.setAttribute("sqlDBId", sqlDBId, PageContext.SESSION_SCOPE);
                    }
                 } 
                if(_jspx_specialsqlDBId == true) {
            // end
            // begin [file="/browsing_stocking.jsp";from=(8,0);to=(8,70)]
                }
            // end
            // HTML // begin [file="/browsing_stocking.jsp";from=(8,70);to=(11,0)]
                out.write("\r\n<body bgcolor=\"#ffffff\">\r\n<h1>进货数据浏览</h1>\r\n");

            // end
            // HTML // begin [file="/browsing_stocking.jsp";from=(11,21);to=(12,0)]
                out.write("\r\n");

            // end
            // begin [file="/browsing_stocking.jsp";from=(12,2);to=(12,58)]
                 rst=sqlDBId.execQuery("Select * from stocking_table"); 
            // end
            // HTML // begin [file="/browsing_stocking.jsp";from=(12,60);to=(13,0)]
                out.write("\r\n");

            // end
            // HTML // begin [file="/browsing_stocking.jsp";from=(13,16);to=(14,0)]
                out.write("\r\n");

            // end
            // begin [file="/browsing_stocking.jsp";from=(14,2);to=(15,42)]
                
                  col=rst.getMetaData().getColumnCount(); 
            // end
            // HTML // begin [file="/browsing_stocking.jsp";from=(15,44);to=(24,0)]
                out.write("\r\n<table  border=\"1\" >\r\n<th>商品代码</th>\r\n<th>商品名称</th>\r\n<th>进货数量</th>\r\n<th>进货价格</th>\r\n<th>包装单位</th>\r\n\r\n<th>进货日期</th>\r\n");

            // end
            // begin [file="/browsing_stocking.jsp";from=(24,2);to=(24,21)]
                 while(rst.next()){
            // end
            // HTML // begin [file="/browsing_stocking.jsp";from=(24,23);to=(26,0)]
                out.write("\r\n<tr>\r\n");

            // end
            // begin [file="/browsing_stocking.jsp";from=(26,2);to=(26,22)]
                for(i=1;i<=col;i++){
            // end
            // HTML // begin [file="/browsing_stocking.jsp";from=(26,24);to=(28,0)]
                out.write("\r\n<td>\r\n");

            // end
            // begin [file="/browsing_stocking.jsp";from=(28,3);to=(28,19)]
                out.print(rst.getString(i));
            // end
            // HTML // begin [file="/browsing_stocking.jsp";from=(28,21);to=(30,0)]
                out.write("\r\n</td>\r\n");

            // end
            // begin [file="/browsing_stocking.jsp";from=(30,2);to=(30,3)]
                }
            // end
            // HTML // begin [file="/browsing_stocking.jsp";from=(30,5);to=(32,0)]
                out.write("\r\n</tr>\r\n");

            // end
            // begin [file="/browsing_stocking.jsp";from=(32,2);to=(32,3)]
                }
            // end
            // HTML // begin [file="/browsing_stocking.jsp";from=(32,5);to=(37,0)]
                out.write("\r\n</table>\r\n<h2><a href=\"index.htm\">回到首页</h2>\r\n</body>\r\n</html>\r\n");

            // end

        } catch (Throwable t) {
            if (out != null && out.getBufferSize() != 0)
                out.clearBuffer();
            if (pageContext != null) pageContext.handlePageException(t);
        } finally {
            if (_jspxFactory != null) _jspxFactory.releasePageContext(pageContext);
        }
    }
}
