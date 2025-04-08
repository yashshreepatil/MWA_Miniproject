import java.io.*;
import javax.servlet.*;
import javax.servlet.http.*;

public class EmployeeServlet extends HttpServlet {
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {

        // Get form data
        String name = request.getParameter("ename");
        String dob = request.getParameter("dob");
        String dept = request.getParameter("dept");
        String salary = request.getParameter("salary");

        // Set content type and respond
        response.setContentType("text/html");
        PrintWriter out = response.getWriter();
        out.println("<html><body>");
        out.println("<h2>Data Entered</h2>");
        out.println("<p>Name: " + name + "</p>");
        out.println("<p>DOB: " + dob + "</p>");
        out.println("<p>Department: " + dept + "</p>");
        out.println("<p>Salary: " + salary + "</p>");
        out.println("</body></html>");
    }
}
