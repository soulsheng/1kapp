//ThirdBean.java
import java.awt.*;
import java.beans.*;
public class ThirdBean extends Canvas{
	//demoString��һ��Bound����
	String demoString="Initial String!";
	private PropertyChangeSupport change=new PropertyChangeSupport(this);
	//�����ַ�������ֵ,���������Ըı��¼�
	public void setdemoString(String newvalue){
		String original=demoString;
		demoString=newvalue;
		change.firePropertyChange("demoString",original,newvalue);
	}
	//����ַ�����ֵ
	public String getString(){
		return demoString;
	}
	//�����ַ��������仯�¼��¼�������
	public void addPropertyChangeListener(PropertyChangeListener l){
	change.addPropertyChangeListener(l);
	}
	//ɾ�������ַ��������仯���¼�������
public void removePropertyChangeListener(PropertyChangeListener l){
	change.removePropertyChangeListener(l);
	}
}
