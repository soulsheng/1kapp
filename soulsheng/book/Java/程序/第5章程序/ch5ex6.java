public class ch5ex6{
	static final int head=1;
	static final int tail=0;
	public static void main(String[]args){
		int freqhead=0;
		int freqtail=0;
		for(int j=0;j<10000;j++){
			if(flipCoin()==head)
				freqhead=freqhead+1;
			if(flipCoin()==tail)
				freqtail=freqtail+1;
		}
		System.out.println("number of head= "+freqhead);
		System.out.println("number of tail= "+freqtail);
	}
	static int flipCoin(){
		return((int)(Math.random()*10000000)%2);
	}
}