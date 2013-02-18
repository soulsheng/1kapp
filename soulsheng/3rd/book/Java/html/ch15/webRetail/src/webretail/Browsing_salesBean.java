package webretail;

public class Browsing_salesBean {
  private String sample = "Start value";
  //Access sample property
  public String getSample() {
    return sample;
  }
  //Access sample property
  public void setSample(String newValue) {
    if (newValue!=null) {
      sample = newValue;
    }
  }
}