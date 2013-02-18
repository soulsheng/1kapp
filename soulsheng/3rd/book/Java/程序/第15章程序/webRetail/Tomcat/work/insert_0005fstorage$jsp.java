package org.apache.jsp;

import javax.servlet.*;
import javax.servlet.http.*;
import javax.servlet.jsp.*;
import org.apache.jasper.runtime.*;


public class insert_0005fstorage$jsp extends HttpJspBase {

    // begin [file="/insert_storage.jsp";from=(7,0);to=(7,68)]
    // end
    // begin [file="/insert_storage.jsp";from=(10,3);to=(10,45)]
         String wareId,warename,wareunit,waredate;
    // end
    // begin [file="/insert_storage.jsp";from=(11,3);to=(11,15)]
         int amount;
    // end
    // begin [file="/insert_storage.jsp";from=(12,3);to=(12,16)]
         float price;
    // end

    static {
    }
    public insert_0005fstorage$jsp( ) {
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

            // HTML // begin [file="/insert_storage.jsp";from=(0,51);to=(7,0)]
                out.write("\r\n<html>\r\n<head>\r\n<title>\r\nInsert_stocking\r\n</title>\r\n</head>\r\n");

            // end
            // begin [file="/insert_storage.jsp";from=(7,0);to=(7,68)]
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
            // begin [file="/insert_storage.jsp";from=(7,0);to=(7,68)]
                }
            // end
            // HTML // begin [file="/insert_storage.jsp";from=(7,68);to=(10,0)]
                out.write("\r\n<body bgcolor=\"#ffffff\">\r\n<h1>成功插入新记录</h1>\r\n");

            // end
            // HTML // begin [file="/insert_storage.jsp";from=(10,47);to=(11,0)]
                out.write("\r\n");

            // end
            // HTML // begin [file="/insert_storage.jsp";from=(11,17);to=(12,0)]
                out.write("\r\n");

            // end
            // HTML // begin [file="/insert_storage.jsp";from=(12,18);to=(13,0)]
                out.write("\r\n");

            // end
            // begin [file="/insert_storage.jsp";from=(13,2);to=(20,18)]
                 wareId=request.getParameter("Wares_ID");
                   warename=request.getParameter("Wares_Name");
                   amount=Integer.valueOf(request.getParameter("Wares_Amount")).intValue();;
                   wareunit=request.getParameter("Wares_Unit");
                   waredate=request.getParameter("Wares_Date");
                  sqlID.execUpdate("insert into storage_table values ('"+
                   wareId+"','"+warename+"',"+amount+",'"+wareunit+"','"+
                   waredate+"')");
            // end
            // HTML // begin [file="/insert_storage.jsp";from=(20,20);to=(25,0)]
                out.write("\r\n</body>\r\n<h2><a href=\"index.htm\">回到首页</h2>\r\n</html>\r\n\r\n");

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
