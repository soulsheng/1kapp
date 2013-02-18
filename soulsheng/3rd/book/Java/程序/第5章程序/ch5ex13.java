public class ch5ex13{
	static void initArray(int a1[][]){
		for(int j=0;j<a1[0].length-1;j++)
			for(int i=0;i<a1.length-1;i++)
				a1[i][j]=(int)(Math.random()*1000000)%100;
		for(int i=0;i<a1.length;i++)
			a1[i][10]=0;
		for(int j=1;j<a1[0].length;j++)
			a1[10][j]=0;
	}
	static void printArray(int a1[][]){
		for(int i=0;i<a1.length;i++){
			for(int j=0;j<a1[0].length;j++)
				System.out.print(a1[i][j]+"  ");
			System.out.println();
		}
	}
	static void sumRows(int a1[][]){
		for(int j=0;j<a1[0].length-1;j++)
			for(int i=0;i<a1.length-1;i++)
				a1[10][j]=a1[10][j]+a1[i][j];
	}
	static void sumColumns(int a1[][]){
		for(int i=0;i<a1.length;i++)
			for(int j=0;j<a1[0].length-1;j++)
				a1[i][10]=a1[i][10]+a1[i][j];
	}
	public static void main(String[]args){
		int a[][]=new int[11][11];
		initArray(a);
		sumRows(a);
		sumColumns(a);
		printArray(a);
	}	
}