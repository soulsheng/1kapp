import java.awt.*;

public class FirstBean extends Canvas{
	String demoString="Demo String";
	//Bean����������ͨ����ͬ
	public FirstBean(){
		setBackground(Color.green);
		setForeground(Color.blue);
	}
	/*set����ֵ*/
	public void setdemoString(String newvalue){
		demoString=newvalue;
	}
	
	/*get����ֵ*/
	public String getdemoString( ){
		return demoString;
	}
}
	