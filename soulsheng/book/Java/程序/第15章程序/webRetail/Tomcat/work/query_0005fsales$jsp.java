package org.apache.jsp;

import java.sql.*;
import javax.servlet.*;
import javax.servlet.http.*;
import javax.servlet.jsp.*;
import org.apache.jasper.runtime.*;


public class query_0005fsales$jsp extends HttpJspBase {

    // begin [file="/query_sales.jsp";from=(8,0);to=(8,68)]
    // end
    // begin [file="/query_sales.jsp";from=(11,3);to=(11,18)]
         String wareID;
    // end
    // begin [file="/query_sales.jsp";from=(13,3);to=(13,19)]
         ResultSet rst; 
    // end
    // begin [file="/query_sales.jsp";from=(15,3);to=(15,14)]
         int col,i;
    // end

    static {
    }
    public query_0005fsales$jsp( ) {
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
            response.setContentType("text/html; charset=gb2312");
            pageContext = _jspxFactory.getPageContext(this, request, response,
            			"", true, 8192, true);

            application = pageContext.getServletContext();
            config = pageContext.getServletConfig();
            session = pageContext.getSession();
            out = pageContext.getOut();

            // HTML // begin [file="/query_sales.jsp";from=(0,51);to=(1,0)]
                out.write("\r\n");

            // end
            // HTML // begin [file="/query_sales.jsp";from=(1,47);to=(8,0)]
                out.write("\r\n<html>\r\n<head>\r\n<title>\r\n进货情况查询结果\r\n</title>\r\n</head>\r\n");

            // end
            // begin [file="/query_sales.jsp";from=(8,0);to=(8,68)]
                webretail.sqlBean sqlID = null;
                boolean _jspx_specialsqlID  = false;
                 synchronized (session) {
                    sqlID= (webretail.sqlBean)
                    pageContext.getAttribute("sqlID",PageContext.SESSION_SCOPE);
                    if ( sqlID == null ) {
                        _jspx_specialsqlID = true;
                        try {
                            sqlID = (webretail.sqlBean) java.beans.Beans.instantiate(this.getClass().getClassLoader(), "webretail.sqlBean");
                        } catch (ClassNotFoundException exc) {
                             throw new InstantiationException(exc.getMessage());
                        } catch (Exception exc) {
                             throw new ServletException (" Cannot create bean of class "+"webretail.sqlBean", exc);
                        }
                        pageContext.setAttribute("sqlID", sqlID, PageContext.SESSION_SCOPE);
                    }
                 } 
                if(_jspx_specialsqlID == true) {
            // end
            // begin [file="/query_sales.jsp";from=(8,0);to=(8,68)]
                }
            // end
            // HTML // begin [file="/query_sales.jsp";from=(8,68);to=(11,0)]
                out.write("\r\n<body bgcolor=\"#ffffff\">\r\n<h1>销售情况查询结果</h1>\r\n");

            // end
            // HTML // begin [file="/query_sales.jsp";from=(11,20);to=(12,0)]
                out.write("\r\n");

            // end
            // begin [file="/query_sales.jsp";from=(12,2);to=(12,43)]
                 wareID=request.getParameter("Wares_ID");
            // end
            // HTML // begin [file="/query_sales.jsp";from=(12,45);to=(13,0)]
                out.write("\r\n");

            // end
            // HTML // begin [file="/query_sales.jsp";from=(13,21);to=(14,0)]
                out.write("\r\n");

            // end
            // begin [file="/query_sales.jsp";from=(14,2);to=(14,80)]
                 rst=sqlID.execQuery("Select * from sales_table where wares_ID='"+wareID+"'");
            // end
            // HTML // begin [file="/query_sales.jsp";from=(14,82);to=(15,0)]
                out.write("\r\n");

            // end
            // HTML // begin [file="/query_sales.jsp";from=(15,16);to=(16,0)]
                out.write("\r\n");

            // end
            // begin [file="/query_sales.jsp";from=(16,2);to=(17,42)]
                
                  col=rst.getMetaData().getColumnCount(); 
            // end
            // HTML // begin [file="/query_sales.jsp";from=(17,44);to=(25,0)]
                out.write("\r\n<table  border=\"1\" >\r\n<th>商品代码</th>\r\n<th>商品名称</th>\r\n<th>销售数量</th>\r\n<th>销售价格</th>\r\n<th>包装单位</th>\r\n<th>销售日期</th>\r\n");

            // end
            // begin [file="/query_sales.jsp";from=(25,2);to=(25,21)]
                 while(rst.next()){
            // end
            // HTML // begin [file="/query_sales.jsp";from=(25,23);to=(27,0)]
                out.write("\r\n<tr>\r\n");

            // end
            // begin [file="/query_sales.jsp";from=(27,2);to=(27,22)]
                for(i=1;i<=col;i++){
            // end
            // HTML // begin [file="/query_sales.jsp";from=(27,24);to=(29,0)]
                out.write("\r\n<td>\r\n");

            // end
            // begin [file="/query_sales.jsp";from=(29,3);to=(29,19)]
                out.print(rst.getString(i));
            // end
            // HTML // begin [file="/query_sales.jsp";from=(29,21);to=(31,0)]
                out.write("\r\n</td>\r\n");

            // end
            // begin [file="/query_sales.jsp";from=(31,2);to=(31,3)]
                }
            // end
            // HTML // begin [file="/query_sales.jsp";from=(31,5);to=(33,0)]
                out.write("\r\n</tr>\r\n");

            // end
            // begin [file="/query_sales.jsp";from=(33,2);to=(33,3)]
                }
            // end
            // HTML // begin [file="/query_sales.jsp";from=(33,5);to=(38,0)]
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
