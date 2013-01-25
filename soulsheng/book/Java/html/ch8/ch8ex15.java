import java.io.*;
public class ch8ex15{
	public static void main(String[]args){
    	try{
    		BufferedReader bIn=new BufferedReader(new InputStreamReader(System.in));
    		int p=0;boolean flag=true;
    		String buffer=bIn.readLine();
    		while (buffer.length()>0 && flag && Character.isWhitespace(buffer.charAt(p))){
    			p++;
    			if(p>=buffer.length()) flag=false;
	   		}
         	if(!flag || buffer.length()<=0)
         		throw new IOException("Do not enter any character beside white space");	    		
    		int st=p;
        	p++;
        	while(p<buffer.length() && !(Character.isWhitespace(buffer.charAt(p))))
           		p++;
        	System.out.println(buffer.substring(st,p));
    	}catch(Exception e){e.printStackTrace();}
	}
}