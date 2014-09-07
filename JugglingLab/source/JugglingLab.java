import jugglinglab.core.*;
import jugglinglab.jml.*;
import jugglinglab.util.*;
import jugglinglab.notation.*;
import jugglinglab.view.*;

public class JugglingLab {

	public static void main(String[] args) throws JuggleExceptionUser, JuggleExceptionInternal {
		Notation not = Notation.getNotation(Notation.builtinNotations[0]);
		String input = args[0];
		String pattern = "pattern=" + input + ";prop=ball";
		JMLPattern pat = not.getJMLPattern(pattern);
		PatternWindow jaw = null;
		try {
			jaw = new PatternWindow(pat.getTitle(), pat, new AnimatorPrefs());
			jaw.view.doMenuCommand(3);//the command for make gif...edited to remove some stuff
		} catch(Exception e) {
			System.out.println(e);
			e.printStackTrace();
		}
	}
}
