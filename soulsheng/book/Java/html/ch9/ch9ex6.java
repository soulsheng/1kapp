class Instrument{
	public void play(){}
	static void tune(Instrument i){
		// ...
    	i.play();
  	}
}
class Wind extends Instrument{
	//...
}
public class ch9ex6{
	public static void main(String[]args){
		Wind flute = new Wind();
    	Instrument.tune(flute); // Upcasting
    }
}