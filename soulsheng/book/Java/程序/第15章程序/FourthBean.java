//FourthBean.java
import java.beans.*;
import java.awt.*;

public class FourthBean extends Canvas{
	int demoInt=0;//=new Integer(0);
	//属性变化监听器
	private PropertyChangeSupport chg=new PropertyChangeSupport(this);
	//否决属性变化监听器
	private VetoableChangeSupport vetos=new VetoableChangeSupport(this);
	//改变属性值,并激发属性变化监听器及否决变化监听器
	public void setdemoInt(int newvalue) throws PropertyVetoException{
		int oldvalue=demoInt;
		vetos.fireVetoableChange("demoInt",new Integer(oldvalue),new Integer(newvalue));
		demoInt=newvalue;
		chg.firePropertyChange("demoInt",new Integer(oldvalue),new Integer(newvalue));
	}
	//增加否决变化监听器
	public void addVetoableChangeListener(VetoableChangeListener l){
		vetos.addVetoableChangeListener(l);
	}
	//删除否决监听器
	public void removeVetoableChangeListener(VetoableChangeListener l){
		vetos.removeVetoableChangeListener(l);
		
	}
}

