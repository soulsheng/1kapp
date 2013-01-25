class Counter{
	private int count;
	public Counter(){
		count=0;
	}
	public void incCount(){
		count++;
	}
	public void decCount(){
		if(count>0)
	  		count--;
	}
	public int getCount(){
		return count;
	}
}
class ExhibitionMonitor extends Counter{
	private int capacity;
	public ExhibitionMonitor(int c){
		super(); 
		capacity=c;
	}
	public int getCapacity(){return capacity;}
	public boolean enter(){
		if(getCount()<capacity){
	    	incCount();
	       	return true;
	    }
	    else
			return false;
	}
	public void leave(){
		if(getCount()>0)
			decCount();
	}
}
public class ch9ex2{
	public static void main(String[]args){
		ExhibitionMonitor cap=new ExhibitionMonitor(100);
		System.out.println("Exhibition Capacity :"+cap.getCapacity());
		for(int j=0;j<60;j++)
			cap.enter();
		System.out.println("Attendance :"+cap.getCount());
		for(int j=0;j<20;j++)
			cap.leave();
		System.out.println("Attendance :"+cap.getCount());
		
	}
}