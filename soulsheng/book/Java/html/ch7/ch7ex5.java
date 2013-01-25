import java.util.*;
public class ch7ex5{
	public static void main(String[]args){
		double d[]=new double[5];
		System.out.println("Input a list:");
		String str=Keyboard.readString();
		StringTokenizer dte=new StringTokenizer(str);
		boolean indexError=false;
		int ind=0;
		while(dte.hasMoreTokens()&&!indexError){
			String s=dte.nextToken();
			try{
				d[ind]=Double.parseDouble(s);
				ind++;
			}catch(NumberFormatException e1){
				System.out.println(e1.getMessage());
			}catch(IndexOutOfBoundsException e2){
				indexError=true;
			}
		}
		if(indexError)
			System.out.println("There are more than 5 string on the list");
		else{
			System.out.println("Number of valid string: "+ind);
			for(int j=0;j<ind;j++)
				System.out.print(d[j]+" , ");
			System.out.println();
		}
	}
}
				