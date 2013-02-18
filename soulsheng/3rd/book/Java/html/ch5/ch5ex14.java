public class ch5ex14{
	public static void main(String[]args){
		int matrix1[][]=new int[3][3];
		int matrix2[][]=new int[3][3];
		int resMulti[][]=new int[3][3];
		int resAdd[][]=new int[3][3];
		int resSub[][]=new int[3][3];
		init(matrix1);
		init(matrix2);
		add(matrix1,matrix2,resAdd);
		sub(matrix1,matrix2,resSub);
		mul(matrix1,matrix2,resMulti);
		System.out.println("Matrix1:");
		printMatrix(matrix1);
		System.out.println("Matrix2:");
		printMatrix(matrix2);
		System.out.println("Added Matrix:");
		printMatrix(resAdd);
		System.out.println("Subtracted Matrix:");
		printMatrix(resSub);
		System.out.println("Multiplied Matrix:");
		printMatrix(resMulti);
		System.out.println();
	}
	static void init(int m1[][]){
		for(int i=0;i<m1.length;i++)
			for(int j=0;j<m1[0].length;j++)
				m1[i][j]=(int)(Math.random()*100000000)%50;
	}
	static void printMatrix(int m1[][]){
		for(int i=0;i<m1.length;i++){
			for(int j=0;j<m1[0].length;j++)
				System.out.print(m1[i][j]+"   ");
			System.out.println();
		}
	}
	static void add(int m1[][],int m2[][],int res[][]){
		for(int i=0;i<m1.length;i++)
			for(int j=0;j<m1[0].length;j++)
				res[i][j]=m1[i][j]+m2[i][j];
	}	
	static void sub(int m1[][],int m2[][],int res[][]){
		for(int i=0;i<m1.length;i++)
			for(int j=0;j<m1[0].length;j++)
				res[i][j]=m1[i][j]-m2[i][j];
	}
	static void mul(int m1[][],int m2[][],int res[][]){
		for(int c=0;c<res[0].length;c++)
			for(int r=0;r<res.length;r++)
				res[r][c]=product(m1,m2,r,c);
	}
	static int product(int m1[][],int m2[][],int r1,int c1){
		int sum=0;
		for(int j=0;j<m2.length;j++)
			sum=sum+m1[r1][j]*m2[j][c1];
		return sum;
	}
}