public class ch4ex7{
	public static void main(String[]args){
		char ch;
		int j,col=0;
		System.out.println();
		for(j=32;j<=126;j++){
			ch=(char)j;
			//16 character per line
			if(col%16==0)
				System.out.println();
			System.out.print(ch+"   ");
			col++;
		}
		System.out.println();
	}
}		