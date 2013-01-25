import java.util.*;
public class ch6ex21{
	public static void main(String[] args) {
		StringTokenizer str=new StringTokenizer("Computing/subject/has/four/branch/that/is/CS/CE/IT/IS","/");
    	while(str.hasMoreTokens()){
    		String st=str.nextToken();
    		System.out.println(st);
    	}
    }
}