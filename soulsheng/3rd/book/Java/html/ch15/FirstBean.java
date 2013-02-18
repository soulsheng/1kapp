import java.awt.*;

public class FirstBean extends Canvas{
	String demoString="Demo String";
	//Bean构造器与普通类相同
	public FirstBean(){
		setBackground(Color.green);
		setForeground(Color.blue);
	}
	/*set属性值*/
	public void setdemoString(String newvalue){
		demoString=newvalue;
	}
	
	/*get属性值*/
	public String getdemoString( ){
		return demoString;
	}
}
	