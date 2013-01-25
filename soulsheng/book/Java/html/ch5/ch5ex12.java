public class ch5ex12{
	public static void main(String[]args){
		int a[][]=new int[5][5];
		int initvalue=1;
		for(int i=0;i<a.length;i++)
			for(int j=0;j<a[0].length;j++){
				a[i][j]=initvalue;
				initvalue=initvalue+1;
			}
		for(int j=0;j<a[0].length;j++){
			for(int i=0;i<a.length;i++)
				System.out.print(a[i][j]+"  ");
			System.out.println();
		}
	}	
}			