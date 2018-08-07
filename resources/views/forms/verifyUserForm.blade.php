@extends('layouts.main')

@section('body')
	<div id="verifyUserForm" class="userLoginRegister">
		<div class="interface large">
			@include('left-column.logo')

			<h1>{{ $user->first_name }}</h1>

			<form id='theForm' method="POST" action="/verifyUser">
				<input type="hidden" id="token" name="token" value="{{ csrf_token() }}">
				<div class="contain">
					<span></span>
					<input type="password" name='pass1' placeholder="Change Password">
					<input type="password" name='pass2' placeholder="Verify Password">
					<input type="hidden" name='user_id' value="{{$user->id}}">
				</div>
			
				<div class="terms view textLeft">
					<div class="inner">
						<h2>INSIDESOURCES, LLC | CONTENT LICENSE AGREEMENT</h2>
						<p>This Content License Agreement (the “Agreement”), dated and effective as of [___], is between InsideSources, LLC, a Delaware limited liability company (“InsideSources”) and the undersigned publisher (the “Licensee”) (collectively referred to as the “parties” or individually as a “party”).</p>
						
						<h2>BACKGROUND</h2>
						<p>Licensee desires to license from InsideSources, and InsideSources desire to license to Licensee, certain syndicated articles owned or held for use by InsideSources that InsideSources chooses to make available for publication by third parties (the “Articles”).</p>
						
						<h2>AGREEMENT</h2>
						<p>The parties hereby agree as follows:</p>
						<ol>
							<li>InsideSources grants to Licensee a non-exclusive, non-assignable, limited license to reproduce and/or display the Articles in the paper publication specified on Exhibit A hereto, and/or its corresponding website. InsideSources may deliver the Articles to Licensee in electronic format, including through access to a web portal.</li>
							<li>The initial term of this Agreement shall be for a period of one month from the date hereof (the “Initial Term”). Following the Initial Term, this Agreement shall automatically renew for additional one month periods unless either party provides written notice of termination at least 10 days prior to the end of the then current term.</li>
							<li>During the Initial Term, the license granted hereby shall be royalty-free with no licensing fee payable. Thereafter, Licensee shall pay InsideSources a licensing fee in the amount and payable with the frequency to be set forth on Exhibit A, as may be updated by InsideSources from time to time.</li>
							<li>Licensee agrees that each Article will be published substantially in its entirety and that the content of any Article will not be altered except for purposes of formatting and editing within accepted industry standards; provided that Licensee may publish an unedited excerpt of an Article so long as the context and meaning of such excerpt is substantially preserved or given. Licensee agrees not to format or edit any Article in a manner that alters the meaning, message, or context of the Article or could lead or result in a third-party claim against InsideSources, including without limitation defamation, copyright infringement, or the violation of a third party’s right of privacy or publicity.</li>
							<li>Licensee agrees to provide conspicuous credit to InsideSources and the underlying author(s) and original publisher of each Article (or any portion thereof) as the source of the Articles and reproduce all copyright notices appearing in the Articles. Licensee will use commercially reasonable efforts to protect the Articles from unauthorized consumption and/or copying.</li>
							<li>Except as expressly allowed herein, Licensee is not authorized to create any derivative works containing or based on the Articles without prior written consent from InsideSources, which may be granted or withheld in its sole discretion. Licensee agrees that any derivative works created by Licensee in violation of this Agreement will be the sole property of InsideSources, and all right, title, and interest, including copyright, to any such derivative work shall be owned solely by InsideSources. Any derivative works consented to by InsideSources shall become the property of Licensee.</li>
							<li>Licensee acknowledges that Licensee obtains no right, title or interest in any Articles except for the license granted hereby, and all right, title and interest in such Articles shall remain with InsideSources or the underlying author or provider, as the case may be.</li>
							<li>Neither party will disclose the terms of this Agreement to any third party, or issue any public announcement regarding the terms of this Agreement, without the other party’s prior written agreement (including email). The parties shall not disclose to any third parties nonpublic information disclosed by one party to the other under this Agreement, and shall protect such information applying the same degree of care used by the parties to protect their own confidential information. If this Agreement or any confidential information of either party is required to be produced by law, the noticed party will promptly notify the other party and cooperate to obtain an appropriate protective order prior to disclosing any confidential information.</li>
							<li>In the event that either party believes the other has failed to comply with any material terms of this Agreement, such party must notify the breaching party in writing. The breaching party will have five (5) business days from the receipt of written notice to cure the alleged breach and to certify to the non-breaching party in writing that cure has been effected. If the breach is not cured within five (5) business days, the non-breaching party has the right to terminate the Agreement immediately upon notice to the breaching party. Upon termination of this Agreement, Licensee’s access to the Articles will be terminated. Authorized copies of any Article already published by Licensee are not required to be removed but may remain published subject to the terms of this Agreement.</li>
							<li>The parties are independent contractors, and nothing in this Agreement creates an agency, partnership, or joint venture.</li>
							<li>Licensee’s rights under this Agreement are not assignable or otherwise transferable without the prior written consent of InsideSources, which may be granted or withheld in its sole discretion.</li>
							<li>No modification or claimed waiver of any provision of this Agreement is valid except by written amendment signed by authorized representatives of InsideSources and Licensee. The waiver or failure of either party to exercise in any respect any right provided for in this Agreement is not a waiver of any further right under this Agreement.</li>
							<li>This Agreement will be deemed to be executed in the Commonwealth of Virginia and construed in accordance with the law of the Commonwealth of Virginia, without regard to any conflict of law principles. The state and federal courts of the District of Columbia</li>
							<li>shall have exclusive jurisdiction over any dispute between the parties hereto and the parties agree that the venue for any dispute will be state and federal courts of the District of Columbia. In the event any provision of this Agreement is found to be illegal or unenforceable by a court of competent jurisdiction, then, in any such event, the provision so found will not affect the validity of the remaining portions and provisions of this Agreement.</li>
							<li>Each of the parties hereby represents and warrants to the other party that is has the right, power, and legal authority to enter into and fully perform this Agreement in accordance with its terms and that this Agreement when executed and delivered by the parties will be a legal, valid, and binding obligation upon the parties in accordance with its terms.</li>
							<li>This Agreement sets forth the entire understanding and agreement of the parties hereto and may not be altered, modified, canceled or terminated except upon the agreement of the parties in writing.</li>
							<li>This Agreement may be executed in one or more counterparts, each of which will be deemed an original and all of which, when taken together, will constitute a single instrument.</li>
						</ol>
					</div>
				</div>
				<div class="submit">
					<label>
						<span>Please read the Terms & Conditions before checking this box:</span>
						<input id="tccRead" type="checkbox">
					</label>
					{{--<button id="verifyUsersubmitForm" class="btn">Complete Registration</button>--}}
					<input type="submit" value="Complete Registration">
				</div>
			</form>

		</div>
	</div>
@stop