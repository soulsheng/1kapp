public class ch4ex2{
	public static void main(String[]args){
		int a[]=new int[1000];
		int count=0;
		double per;
		for(int j=0;j<a.length;j++){
			a[j]=(int)(Math.random()*1000000)%50;
			if(a[j]==6)
				count++;
		}
		per=(double)count*100/1000;
		System.out.println("the number of 6:"+count);
		System.out.println("the percentage of 6:"+per+"%");
	}
}