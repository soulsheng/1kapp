//ThirdBean.java
import java.awt.*;
import java.beans.*;
public class ThirdBean extends Canvas{
	//demoString是一个Bound属性
	String demoString="Initial String!";
	private PropertyChangeSupport change=new PropertyChangeSupport(this);
	//设置字符串的新值,将激发属性改变事件
	public void setdemoString(String newvalue){
		String original=demoString;
		demoString=newvalue;
		change.firePropertyChange("demoString",original,newvalue);
	}
	//获得字符串的值
	public String getString(){
		return demoString;
	}
	//增加字符串发生变化事件事件监听器
	public void addPropertyChangeListener(PropertyChangeListener l){
	change.addPropertyChangeListener(l);
	}
	//删除监听字符串发生变化的事件监听器
public void removePropertyChangeListener(PropertyChangeListener l){
	change.removePropertyChangeListener(l);
	}
}
