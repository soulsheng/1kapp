import java.io.*;
import java.util.*;
public class ch8ex7{
	public static void main(String[]args){
		try{
			PrintWriter outputStream=new PrintWriter(new FileOutputStream("student1.txt"));
			BufferedReader inputStream=new BufferedReader(new FileReader("student.txt"));	
			StringTokenizer t;
			int score[]=new int[4];
			int index;
			int accumulateScore;
			double average;
			String line=inputStream.readLine();
			while(line!=null){
				t=new StringTokenizer(line);
				String studentID=t.nextToken();
				accumulateScore=0;
				index=0;
				while(t.hasMoreTokens()){
					Integer sc=new Integer(t.nextToken());
					score[index]=sc.intValue();
					accumulateScore=accumulateScore+score[index];
					index++;
				}
				average=accumulateScore/4.0;
				String out;
				out=studentID+" ";
				for(index=0;index<4;index++)
					out=out+score[index]+" ";
				out=out+average;
				outputStream.println(out);
				line=inputStream.readLine();
			}
			outputStream.close();
			inputStream.close();
		}catch(Exception e){
			System.out.println(e.getMessage());
		}
	}
}
				
							

		