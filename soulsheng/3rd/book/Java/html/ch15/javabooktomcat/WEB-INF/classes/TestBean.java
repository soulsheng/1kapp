package test; 
public class TestBean{ 
	private String name = null; 
	public TestBean(String strName_p){
		this.name=strName_p;
	} 
	public void setName(String strName_p){ 
		this.name=strName_p;  
	} 
	public String getName(){
		return this.name; 
	}  
} 
