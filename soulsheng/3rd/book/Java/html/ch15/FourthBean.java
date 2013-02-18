//FourthBean.java
import java.beans.*;
import java.awt.*;

public class FourthBean extends Canvas{
	int demoInt=0;//=new Integer(0);
	//���Ա仯������
	private PropertyChangeSupport chg=new PropertyChangeSupport(this);
	//������Ա仯������
	private VetoableChangeSupport vetos=new VetoableChangeSupport(this);
	//�ı�����ֵ,���������Ա仯������������仯������
	public void setdemoInt(int newvalue) throws PropertyVetoException{
		int oldvalue=demoInt;
		vetos.fireVetoableChange("demoInt",new Integer(oldvalue),new Integer(newvalue));
		demoInt=newvalue;
		chg.firePropertyChange("demoInt",new Integer(oldvalue),new Integer(newvalue));
	}
	//���ӷ���仯������
	public void addVetoableChangeListener(VetoableChangeListener l){
		vetos.addVetoableChangeListener(l);
	}
	//ɾ�����������
	public void removeVetoableChangeListener(VetoableChangeListener l){
		vetos.removeVetoableChangeListener(l);
		
	}
}

