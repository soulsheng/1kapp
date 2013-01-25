public class ch7ex4{
	public static void main(String[]args){
		try{
			int a[]={12,34,23,45,67};
			int sum=0;
			//循环将超出数组的下标
			for(int j=0;j<6;j++)
				sum=sum+a[j];
			System.out.println("you won't see this!");
		}catch(ArrayIndexOutOfBoundsException e){
			e.printStackTrace();
		}
	}
}			