public class ch3ex11{
	public static void main(String[]args){
		int j,c,count;
		count=0;
		for(j=0;j<=10000;j=j+1){
			c=(int)(Math.random()*1000000%6+1);
			if(c==3)
				count++;
		}
		System.out.println("The number of 3 presented="+count);
		System.out.println("The probability="+(double)count/10000);	
	}
}
